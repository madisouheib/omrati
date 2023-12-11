<!-- SignUpWizard.vue -->

<template>
    <section class="signup-step-container">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    <div class="wizard">
                        <div class="wizard-inner">
                            <div class="connecting-line"></div>
                            <ul class="nav nav-tabs" role="tablist">
                                <li
                                    v-for="(tab, index) in tabs"
                                    :key="index"
                                    :class="{
                                        active: tab.isActive,
                                        disabled: !tab.isActive,
                                    }"
                                >
                                    <a
                                        href="#"
                                        @click.prevent="activateTab(tab)"
                                        ><span class="round-tab">{{
                                            index + 1
                                        }}</span>
                                        <i>{{ tab.label }}</i></a
                                    >
                                </li>
                            </ul>
                        </div>

                        <form role="form" action="index.html" class="login-box">
                            <div class="tab-content" id="main_form">
                                <div
                                    v-for="(tab, index) in tabs"
                                    :key="index"
                                    class="tab-pane"
                                    role="tabpanel"
                                    :class="{ active: tab.isActive }"
                                >
                                    <h4 class="text-center">{{ tab.label }}</h4>
                                    <!-- Your form fields for each step go here -->
                                    <!-- Example: -->
                                    <div v-if="tab.id === 1">
                                        <!-- Step 1 Form Fields -->
                                        <!-- ... -->
                                    </div>
                                    <div v-else-if="tab.id === 2">
                                        <!-- Step 2 Form Fields -->
                                        <!-- ... -->
                                    </div>
                                    <!-- Add more conditions for other steps -->

                                    <ul class="list-inline pull-right">
                                        <li v-if="index > 0">
                                            <button
                                                type="button"
                                                class="default-btn prev-step"
                                                @click="prevStep"
                                            >
                                                Back
                                            </button>
                                        </li>
                                        <li v-if="index < tabs.length - 1">
                                            <button
                                                type="button"
                                                class="default-btn next-step"
                                                @click="nextStep"
                                            >
                                                Continue
                                            </button>
                                        </li>
                                        <li v-else>
                                            <button
                                                type="button"
                                                class="default-btn next-step"
                                                @click="finish"
                                            >
                                                Finish
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            tabs: [
                { id: 1, label: "Step 1", isActive: true },
                { id: 2, label: "Step 2", isActive: false },
                // Add more steps as needed
            ],
        };
    },
    methods: {
        activateTab(tab) {
            if (!tab.isActive) {
                this.tabs.forEach((t) => (t.isActive = t.id === tab.id));
            }
        },
        nextStep() {
            const activeIndex = this.tabs.findIndex((tab) => tab.isActive);
            if (activeIndex < this.tabs.length - 1) {
                this.activateTab(this.tabs[activeIndex + 1]);
            }
        },
        prevStep() {
            const activeIndex = this.tabs.findIndex((tab) => tab.isActive);
            if (activeIndex > 0) {
                this.activateTab(this.tabs[activeIndex - 1]);
            }
        },
        finish() {
            // Implement logic for finishing the wizard
            alert("Wizard completed!");
        },
    },
};
</script>

<style scoped>
/* Add your component-specific styles here if needed */

</style>
