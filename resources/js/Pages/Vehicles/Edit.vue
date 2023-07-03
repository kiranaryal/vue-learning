<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


const props = defineProps({
    vehicle: {
        type: Object,
        default: () => ({}),
    },
});

const form = useForm({
    id: props.vehicle.id,
    name: props.vehicle.name,
    type: props.vehicle.type,

});


const submit = () => {
    form.put(route("vehicle.update", props.vehicle.id));
};
;
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Vehicles
            </h2>
        </template>

        <div class="container mx-auto px-4">
            <form @submit.prevent="submit">

                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Name</label>
                    <input type="text" v-model="form.name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    <div v-if="form.errors.name" class="text-sm text-red-600">
                        {{ form.errors.name }}
                    </div>
                </div>
                <div class="mb-6">
                    <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">Type</label>
                    <input type="text" v-model="form.type" name="type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    <div v-if="form.errors.type" class="text-sm text-red-600">
                        {{ form.errors.type }}
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


