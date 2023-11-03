<?php


    namespace Modules\Flight\Admin;


    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\Validation\Rule;
    use Maatwebsite\Excel\Facades\Excel;
    use Modules\AdminController;
    use Modules\Flight\Imports\AirportImportIATA;
    use Modules\Flight\Models\Airport;
    use Modules\Flight\Models\Flight;
    use Modules\Location\Models\Location;

    class AirportController extends AdminController
    {
        /**
         * @var string
         */
        private $airport;
        /**
         * @var string
         */
        private $location;

        /**
         * @var string
         */

        public function __construct()
        {
            $this->setActiveMenu(route('flight.admin.index'));
            $this->location = Location::class;
            $this->airport = Airport::class;
        }

        public function callAction($method, $parameters)
        {
            if (!Flight::isEnable()) {
                return redirect('/');
            }
            return parent::callAction($method, $parameters); // TODO: Change the autogenerated stub
        }

        public function index(Request $request)
        {
            $this->checkPermission('flight_view');
            $query = $this->airport::query();
            $query->orderBy('id', 'desc');

            if ($s = $request->input('s')) {
                $query->where(function($query) use($s){
                    $query->where('name', 'LIKE', '%'.$s.'%');
                    $query->orWhere('address', 'LIKE', '%'.$s.'%');
                    $query->orWhere('code', $s);
                });
            }
            if ($this->hasPermission('flight_manage_others')) {
                if (!empty($author = $request->input('vendor_id'))) {
                    $query->where('author_id', $author);
                }
            } else {
                $query->where('author_id', Auth::id());
            }
            $data = [
                'rows'                 => $query->with(['author'])->paginate(50),
                'row'                  => new $this->airport,
                'locations'   => $this->location::get()->toTree(),
                'flight_manage_others' => $this->hasPermission('flight_manage_others'),
                'breadcrumbs'          => [
                    [
                        'name' => __('Airport'),
                        'url'  => route('flight.admin.airport.index')
                    ],
                    [
                        'name'  => __('All'),
                        'class' => 'active'
                    ],
                ],
                'page_title'           => __("Airport Management")
            ];
            return view('Flight::admin.airport.index', $data);
        }

        public function edit(Request $request, $id)
        {
            $this->checkPermission('flight_update');
            $row = $this->airport::find($id);
            if (empty($row)) {
                return redirect(route('flight.admin.airport.index'));
            }
            if (!$this->hasPermission('flight_manage_others')) {
                if ($row->author_id != Auth::id()) {
                    return redirect(route('flight.admin.index'));
                }
            }
            $data = [
                'row'         => $row,
                'locations'   => $this->location::get()->toTree(),
                'breadcrumbs' => [
                    [
                        'name' => __('Airport'),
                        'url'  => route('flight.admin.airport.index')
                    ],
                    [
                        'name'  => __('Edit airport'),
                        'class' => 'active'
                    ],
                ],
                'page_title'  => __("Edit: :name", ['name' => $row->code])
            ];
            return view('Flight::admin.airport.detail', $data);
        }

        public function store(Request $request, $id)
        {
            if ($id > 0) {
                $request->validate([
                    'name'=>'required',
                    'code'=>[
                        'required',
                        Rule::unique(Airport::getTableName())
                    ]
                ]);
                $this->checkPermission('flight_update');
                $row = $this->airport::find($id);
                if (empty($row)) {
                    return redirect(route('flight.admin.airport.index'));
                }

                if ($row->author_id != Auth::id() and !$this->hasPermission('flight_manage_others')) {
                    return redirect(route('flight.admin.airport.index'));
                }
            } else {
                $this->checkPermission('flight_create');
                $row = new $this->airport();
            }
            $validator = Validator::make($request->all(), [
                'name'=>'required',
                'code'=>[
                    'required',
                    Rule::unique(Airport::getTableName())->ignore($row),
                ]
            ]);
            if ($validator->fails()) {
                return redirect()->back()->with(['errors' => $validator->errors()]);
            }
            $dataKeys = [
                'name',
                'code',
                'location_id',
                'address',
                'status'
            ];
            if ($this->hasPermission('flight_manage_others')) {
                $dataKeys[] = 'author_id';
            }
            $row->fillByAttr($dataKeys, $request->input());
            $res = $row->save();
            if ($res) {
                return redirect(route('flight.admin.airport.edit', $row))->with('success', __('Airport saved'));
            }
        }


        public function importIATA(){
            $file = base_path('/modules/Flight/Resources/airports.xlsx');
            Excel::queueImport(new AirportImportIATA, $file);
            return back()->with("success",__("Import Queued"));
        }

        public function bulkEdit(Request $request)
        {

            $ids = $request->input('ids');
            $action = $request->input('action');
            if (empty($ids) or !is_array($ids)) {
                return redirect()->back()->with('error', __('No items selected!'));
            }
            if (empty($action)) {
                return redirect()->back()->with('error', __('Please select an action!'));
            }

            switch ($action) {
                case "delete":
                    foreach ($ids as $id) {
                        $query = $this->airport::where("id", $id);
                        if (!$this->hasPermission('flight_manage_others')) {
                            $query->where("create_user", Auth::id());
                            $this->checkPermission('flight_delete');
                        }
                        $row = $query->first();
                        if (!empty($row)) {
                            $row->delete();
                        }
                    }
                    return redirect()->back()->with('success', __('Deleted success!'));
                    break;
                case "permanently_delete":
                    foreach ($ids as $id) {
                        $query = $this->airport::where("id", $id);
                        if (!$this->hasPermission('flight_manage_others')) {
                            $query->where("create_user", Auth::id());
                            $this->checkPermission('flight_delete');
                        }
                        $row = $query->first();
                        if ($row) {
                            $row->delete();
                        }
                    }
                    return redirect()->back()->with('success', __('Permanently delete success!'));
                    break;
                case "clone":
                    $this->checkPermission('flight_create');
                    foreach ($ids as $id) {
                        (new $this->airport())->saveCloneByID($id);
                    }
                    return redirect()->back()->with('success', __('Clone success!'));
                    break;
                default:
                    // Change status
                    foreach ($ids as $id) {
                        $query = $this->airport::where("id", $id);
                        if (!$this->hasPermission('flight_manage_others')) {
                            $query->where("create_user", Auth::id());
                            $this->checkPermission('flight_update');
                        }
                        $row = $query->first();
                        $row->status = $action;
                        $row->save();
                    }
                    return redirect()->back()->with('success', __('Update success!'));
                    break;
            }


        }
        public function getForSelect2(Request $request)
        {
            $pre_selected = $request->query('pre_selected');
            $selected = $request->query('selected');

            if($pre_selected && $selected){
                $item = $this->airport::find($selected);
                if(empty($item)){
                    return response()->json([
                        'text'=>''
                    ]);
                }else{
                    return response()->json([
                        'text'=>$item->name
                    ]);
                }
            }
            $q = $request->query('q');
            $query = $this->airport::select('id', 'name as text');
            if ($q) {
                $query->where('name', 'like', '%' . $q . '%');
            }
            $res = $query->orderBy('id', 'desc')->limit(20)->get();
            return response()->json([
                'results' => $res
            ]);
        }

    }
