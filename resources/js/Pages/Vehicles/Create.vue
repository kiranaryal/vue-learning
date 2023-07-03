<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


const form = useForm({
    name: '',
    type: '',

});

const submit = () => {
    form.post(route("vehicle.store"));

};


</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Vehicles Available
            </h2>
        </template>

        <div class="container mx-auto px-4">

            <div class=" items-center  justify-end p-6 border-t border-solid border-slate-200 rounded-b">
                <form @submit.prevent="submit" type="post">
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


