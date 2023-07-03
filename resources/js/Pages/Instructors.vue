<script setup>
import { Head, Link } from '@inertiajs/vue3';
import { useDark, useToggle } from '@vueuse/core';
import { useForm } from "@inertiajs/vue3";


defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    instructors: {
        type: Array,
        default: () => [],
    },
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
        <div class="flex flex-col ">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm font-light text-gray-900 dark:text-gray-300">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Name</th>
                                        <th scope="col" class="px-6 py-4">Vehicle</th>
                                        <th scope="col" class="px-6 py-4">Gender</th>
                                        <th scope="col" class="px-6 py-4">Age</th>
                                        <th scope="col" class="px-6 py-4">Qualilfication</th>
                                        <!-- <th scope="col" class="px-6 py-4">Experience</th> -->
                                        <th scope="col" class="px-6 py-4">Status</th>

                                        <th scope="col" class="px-6 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(q, i) in instructors" class="border-b dark:border-neutral-500" :key="q.id">

                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ i + 1 }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.name }}</td>
                                        <td  class="whitespace-nowrap px-6 py-4">
                                            <div v-for="vehicle in vehicles">{{ vehicle.id == q.vehicle ? vehicle.name:'' }}</div> </td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.gender }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.age }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.qualification }}</td>
                                        <!-- <td class="whitespace-nowrap px-6 py-4">{{ q.experience }}</td> -->
                                        <!-- <td class="whitespace-nowrap px-6 py-4">{{ q.status }}</td> -->

                                        <td class="flex">
                                            <div
                                                class="text-green-800 bg-transparent border-green-500 hover:bg-green-800 hover:text-white active:bg-green-900 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 transition-all duration-150"
                                            >
                                                <Link :href="route('instructor.edit', { instructor: q.id })">apply</Link>
                                            </div>
                                            <!-- <div
                                                class="text-red-800 bg-transparent border-red-500 hover:bg-red-800 hover:text-white active:bg-red-900 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 transition-all duration-150"
                                            >
                                                <form @submit.prevent="submit_delete(i)">
                                                    <input type="hidden"  :value="q.id">
                                                    <button type="submit" :disabled="form_delete.processing">delete</button>
                                                </form>
                                            </div> -->
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
