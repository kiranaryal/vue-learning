<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { useForm } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";
// import route from 'vendor/tightenco/ziggy/src/js';


const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
    quiz2: {
        type: Object,
        default: () => ({}),
    },
});
const form = useForm({
    name: '',

});
const form2 = useForm({
    id: props.quiz2.id,
    name: props.quiz2.name,

});
const submit = () => {
    form.post(route("quiz.store"));
};
const submit2 = () => {
    form2.put(route("quiz.update", props.quiz2.id));
};
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Quizs
            </h2>
        </template>

        <div>
            <div v-for="q in quiz">

                {{ q.name }}
                <Link :href="
                    route(
                        'quiz.edit',
                        q.id
                    )
                "> edit</Link>
            </div>
            <form v-if="!quiz2.name" @submit.prevent="submit">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">name</label>
                    <input type="text" v-model="form.name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="" />
                    <div v-if="form.errors.name" class="text-sm text-red-600">
                        {{ form.errors.name }}
                    </div>
                </div>

                <button type="submit"
                    class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                    :disabled="form.processing" :class="{ 'opacity-25': form.processing }">
                    Submit
                </button>
            </form>

            <form v-if="quiz2.name" @submit.prevent="submit2">
                <div class="mb-6">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300">name</label>
                    <input type="text" v-model="form2.name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" />
                    <div v-if="form2.errors.name" class="text-sm text-red-600">
                        {{ form2.errors.name }}
                    </div>
                </div>


                <button type="submit"
                    class="text-white bg-blue-700  focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 "
                    :disabled="form2.processing" :class="{ 'opacity-25': form.processing }">
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
