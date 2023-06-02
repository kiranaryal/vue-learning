<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';

const props = defineProps({
    quiz: {
        type: Object,
        default: () => ({}),
    },
});
</script>

<template>
    <AppLayout title="Profile">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Quizs
            </h2>
        </template>

        <div>a
                <div v-for="q in quiz" >

                        {{ q.name }}
                </div>

        </div>
    </AppLayout>
</template>


