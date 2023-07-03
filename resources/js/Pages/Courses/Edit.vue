<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


const props = defineProps({
    courses: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.courses.id,
    name: props.courses.name,
    type: props.courses.type,
    time: props.courses.time,
    status:props.courses.status,
    vat: props.courses.vat,
    rate: props.courses.rate,
});


const submit = () => {
    form.put(route("courses.update", props.courses.id));
};
;
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit courses
            </h2>
        </template>

        <div class="container mx-auto px-4">
            <form @submit.prevent="submit">

                <div class="columns-2">


                    <div class="mb-6">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                        <input type="text" v-model="form.name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="" />
                        <div v-if="form.errors.name" class="text-sm text-red-600">
                            {{ form.errors.name }}
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Type</label>
                        <input type="text" v-model="form.type" name="type"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="" />
                        <div v-if="form.errors.type" class="text-sm text-red-600">
                            {{ form.errors.type }}
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="time"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Time</label>
                        <input type="text" v-model="form.time" name="time"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="" />
                        <div v-if="form.errors.time" class="text-sm text-red-600">
                            {{ form.errors.time }}
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="rate"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Rate</label>
                        <input Type="text" v-model="form.rate" name="rate"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                            placeholder="" />
                        <div v-if="form.errors.rate" class="text-sm text-red-600">
                            {{ form.errors.rate }}
                        </div>
                    </div>

                    <div class="mb-6 mr-3">
                        <label for="vat" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vat</label>

                        <select id="countries" v-model="form.vat" name="vat"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="0">0%</option>
                            <option value="13">13%</option>

                        </select>
                        <div v-if="form.errors.vat" class="text-sm text-red-600">
                            {{ form.errors.vat }}
                        </div>
                    </div>
                    <div class="mb-6 mr-3">

                        <label for="status"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" v-model="form.status" name="status"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                        <div v-if="form.errors.status" class="text-sm text-red-600">
                            {{ form.errors.status }}
                        </div>

                    </div>

                </div>
                <button type="submit"
                    class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                    :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    Submit
                </button>
            </form>

        </div>
    </AppLayout>
</template>

<script>
export default {
    components: {
        Link
    },
}
</script>


