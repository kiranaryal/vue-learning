<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { useDark, useToggle } from '@vueuse/core';
import { useForm } from "@inertiajs/vue3";


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    vehicles: {
        type: Array,
        default: () => [],
    },
});
const isDark = useDark();
const toggleDark = useToggle(isDark);


const form = useForm({
    vehicle: '',
    age: '',
    gender: '',
    qualification: '',
    experience: '',
});


const submit = () => {
    form.post(route("instructor.get"));

};

</script>

<template>
    <Head title="Welcome"/>
    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
        <div class="sm:fixed sm:top-0 sm:left-0 p-6 text-left z-10">
            <button @click="toggleDark()">
                <span class="ml-2 text-gray-800 dark:text-gray-200">{{ isDark ? 'Dark' : 'Light' }}</span>
            </button>
        </div>

        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
            <Link v-if="$page.props.auth.user" :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
            Dashboard</Link>

            <template v-else>
                <Link :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Log in</Link>

                <Link v-if="canRegister" :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                Register</Link>
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">



            <div class="container mx-auto px-4 w-screen">

                <div class=" items-center  justify-end p-6 border-t border-solid border-slate-200 rounded-b ">
                    <form @submit.prevent="submit" type="post">
                        <div class="columns-2">
                            <div>
                                <h2 class="ml-6 text-gray-800 dark:text-gray-200">Select your Preferences</h2>
                            <br>
                            <br>
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
                            Check
                        </button>
                    </form>

                </div>


                <div class="flex justify-center mt-16 px-6 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">
                        <div class="flex items-center gap-4">
                            <a href="#"
                                class="group inline-flex items-center hover:text-gray-700 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    class="-mt-px mr-1 w-5 h-5 stroke-gray-400 dark:stroke-gray-600 group-hover:stroke-gray-600 dark:group-hover:stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                                </svg>
                                Support
                            </a>
                        </div>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">

                        By: Nischal
                    </div>
                </div>
            </div>
        </div>
        </div>
</template>

<style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}

@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style>
<script>
export default {
    components: {
        Link
    }
}
</script>
