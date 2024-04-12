<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, useForm} from '@inertiajs/vue3';
import TextInput from "@/Components/TextInput.vue";
import InputLabel from "@/Components/InputLabel.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";

const form = useForm({
    name: '',
    original_url: '',
});


const saveShortUrl = () => {
    form.post(route('url.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
    });
};

</script>

<template>
    <Head title="Urls" />

    <AuthenticatedLayout>
        <template #header>

        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-8">
                    <header>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Create a short url</h2>

                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Fill in below details to create a short url
                        </p>
                    </header>
                    <form @submit.prevent="saveShortUrl" class="mt-6 space-y-6">
                        <div>
                            <InputLabel for="name" value="URL Name" />
                            <TextInput
                                id="name"
                                v-model="form.name"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="Url Name"
                                autocomplete="url-name"
                            />

                            <InputError :message="form.errors.name" class="mt-2" />
                        </div>

                        <div>
                            <InputLabel for="original_url" value="Original URL" />
                            <TextInput
                                id="original_url"
                                v-model="form.original_url"
                                type="text"
                                class="mt-1 block w-full"
                                placeholder="Original URL"
                                autocomplete="original-url"
                            />

                            <InputError :message="form.errors.original_url" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                            <Transition
                                enter-active-class="transition ease-in-out"
                                enter-from-class="opacity-0"
                                leave-active-class="transition ease-in-out"
                                leave-to-class="opacity-0"
                            >
                                <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                            </Transition>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
