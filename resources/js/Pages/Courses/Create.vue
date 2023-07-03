<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


const form = useForm({
    name: '',
    type: '',
    time: '',
    status:'',
    vat: '',
    rate: '',
});
const props = defineProps({
    vehicles: {
        type: Array,
        default: () => [],
    },
});

const submit = () => {
    form.post(route("courses.store"));

};

</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Courses Available
            </h2>
        </template>

        <div class="container mx-auto px-4 w-screen">

            <div class=" items-center  justify-end p-6 border-t border-solid border-slate-200 rounded-b ">
                <form @submit.prevent="submit" type="post">
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
                        </div><div class="mb-6">
                            <label for="type"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Type</label>
                                <select v-model="form.type"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option v-for="vehicle in vehicles" :value="vehicle.id" name="type">
                                    {{ vehicle.name }}
                                </option>
                                </select>
                            <div v-if="form.errors.type" class="text-sm text-red-600">
                                {{ form.errors.type }}
                            </div>
                        </div>

                        <div class="mb-6 mr-3">
                            <label for="vat"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vat</label>

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
                    <button
                            class="text-green-700 background-transparent font-bold uppercase px-6 py-2 text-sm outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                            type="submit">
                            Save Changes
                        </button>
                </form>

            </div>

        </div>
    </AppLayout>
</template>

<script>
export default {
    components: {
        Link
    }
}
</script>


