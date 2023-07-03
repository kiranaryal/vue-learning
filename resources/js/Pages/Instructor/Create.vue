<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


const form = useForm({
    name: '',
    vehicle: '',
    age: '',
    gender: '',
    qualification: '',
    experience: '',
});
const props = defineProps({
    vehicles: {
        type: Array,
        default: () => [],
    },
});

const submit = () => {
    form.post(route("instructor.store"));

};

</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Instructors Available
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
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Age</label>
                            <input type="number" v-model="form.age" name="age"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                placeholder="" />
                            <div v-if="form.errors.age" class="text-sm text-red-600">
                                {{ form.errors.age }}
                            </div>
                        </div>
                        <div class="mb-6 mr-3">

                            <label for="qualification"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Qualilfication</label>
                            <select id="qualification" v-model="form.qualification" name="qualification"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="1">UnCertified</option>
                                <option value="2">Certified</option>

                            </select>
                            <div v-if="form.errors.qualification" class="text-sm text-red-600">
                                {{ form.errors.qualification }}
                            </div>

                        </div>
                        <div class="mb-6">
                            <label for="vehicle"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Vehicle</label>
                            <select v-model="form.vehicle"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                                <option v-for="vehicle in vehicles" :value="vehicle.id" name="vehicle">
                                    {{ vehicle.name }}
                                </option>
                            </select>
                            <div v-if="form.errors.vehicle" class="text-sm text-red-600">
                                {{ form.errors.vehicle }}
                            </div>
                        </div>

                        <div class="mb-6 mr-3">
                            <label for="gender"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Gender</label>

                            <select id="countries" v-model="form.gender" name="gender"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option value="1">male</option>
                                <option value="2">female</option>
                                <option value="3">other</option>


                            </select>
                            <div v-if="form.errors.gender" class="text-sm text-red-600">
                                {{ form.errors.gender }}
                            </div>
                        </div>
                        <div class="mb-6 mr-3">

                            <label for="experience"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Experience</label>
                            <select id="experience" v-model="form.experience" name="experience"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected value="1">0-1 years</option>
                                <option value="2">1-3 years</option>
                                <option value="3">3-5 years</option>
                                <option value="4">5-10 years</option>
                                <option value="5">10+ years</option>



                            </select>
                            <div v-if="form.errors.experience" class="text-sm text-red-600">
                                {{ form.errors.experience }}
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


