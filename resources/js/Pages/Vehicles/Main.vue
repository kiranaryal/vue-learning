<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    vehicle: {
        type: Array,
        default: () => [],
    },
});

const form_delete = useForm({
    vehicle: '',
});

const submit_delete = (i) => {
    form_delete.delete(route("vehicle.destroy", props.vehicle[i]));
};
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                Vehicles Available
            </h2>
        </template>

        <div class="container mx-auto px-4 mt-4 w-screen">
            <div>
                <Link
                    class="bg-green-900 text-white active:bg-green-600 font-bold uppercase text-sm mt-5 px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 ease-linear transition-all duration-150"
                    :href="route('vehicle.create')"
                >
                    Add Vehicle
                </Link>
            </div>

            <div class="flex flex-col overflow-x-auto">
                <div class="sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                        <div class="overflow-x-auto">
                            <table class="min-w-full text-left text-sm font-light text-gray-900 dark:text-gray-300">
                                <thead class="border-b font-medium dark:border-neutral-500">
                                    <tr>
                                        <th scope="col" class="px-6 py-4">#</th>
                                        <th scope="col" class="px-6 py-4">Name</th>
                                        <th scope="col" class="px-6 py-4">Type</th>
                                        <th scope="col" class="px-6 py-4">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(q, i) in vehicle" class="border-b dark:border-neutral-500" :key="q.id">
                                        <td class="whitespace-nowrap px-6 py-4 font-medium">{{ i + 1 }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.name }}</td>
                                        <td class="whitespace-nowrap px-6 py-4">{{ q.type }}</td>
                                        <td class="flex">
                                            <div
                                                class="text-green-800 bg-transparent border-green-500 hover:bg-green-800 hover:text-white active:bg-green-900 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 transition-all duration-150"
                                            >
                                                <Link :href="route('vehicle.edit', { vehicle: q.id })">edit</Link>
                                            </div>
                                            <div
                                                class="text-red-800 bg-transparent border-red-500 hover:bg-red-800 hover:text-white active:bg-red-900 font-bold uppercase text-sm px-6 py-3 rounded outline-none focus:outline-none mr-1 mb-1 transition-all duration-150"
                                            >
                                                <form @submit.prevent="submit_delete(i)">
                                                    <input type="hidden"  :value="q.id">
                                                    <button type="submit" :disabled="form_delete.processing">delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
