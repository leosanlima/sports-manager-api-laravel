<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>

            <!-- Menu de navegação em abas -->
            <nav class="border-b border-gray-200">
                    <ul class="flex space-x-8" aria-label="Tabs">
                        <li>
                            <inertia-link href="/players" class="text-blue-600 hover:text-blue-800 px-3 py-2 border-b-2"
                                :class="isActive('/players') ? 'border-blue-600' : 'border-transparent'">
                                Players
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/teams" class="text-blue-600 hover:text-blue-800 px-3 py-2 border-b-2"
                                :class="isActive('/teams') ? 'border-blue-600' : 'border-transparent'">
                                Teams
                            </inertia-link>
                        </li>
                        <li>
                            <inertia-link href="/games" class="text-blue-600 hover:text-blue-800 px-3 py-2 border-b-2"
                                :class="isActive('/games') ? 'border-blue-600' : 'border-transparent'">
                                Games
                            </inertia-link>
                        </li>
                    </ul>
                </nav>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script>
export default {
    methods: {
        isActive(route) {
            return window.location.pathname === route;
        }
    }
}
</script>

<style scoped>
/* Estilos para as abas */
nav ul {
    list-style-type: none;
    padding: 0;
    display: flex;
    gap: 1rem;
}

nav ul li {
    margin-bottom: 0;
}

.inertia-link {
    text-decoration: none;
}

.border-b-2 {
    border-bottom-width: 2px;
}
</style>