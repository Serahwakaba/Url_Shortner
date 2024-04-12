<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, Link} from '@inertiajs/vue3';
import PrimaryButton from "@/Components/PrimaryButton.vue";

defineProps<{
    urls?: any[];
    prefix?: string
}>();
</script>

<template>
    <Head title="Urls" />

    <AuthenticatedLayout>
        <template #header>
            <section class="w-full flex flex-row justify-between">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"> Short Urls </h2>
                <Link :href="route('url.create')" class="justify-end">
                    <PrimaryButton>Create Short Url</PrimaryButton>
                </Link>
            </section>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 divide-y">
                   <section v-for="url in urls" :key="url.id" class="my-6 p-5">
                      <div>
                          <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                              Name: {{url.name}}
                          </h5>
                          <p class="text-black dark:text-white">
                              Short Url:
                              <a target="_blank" :href="prefix  + url.short_url" class="inline-flex font-medium items-center text-blue-600 hover:underline">
                                  {{prefix  + url.short_url}}
                              </a>
                          </p>
                          <p class="text-black dark:text-white">
                              Original Url:
                              <a class="text-blue-600 hover:underline" :href="url.original_url">{{url.original_url}}</a>
                          </p>
                      </div>
                   </section>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
