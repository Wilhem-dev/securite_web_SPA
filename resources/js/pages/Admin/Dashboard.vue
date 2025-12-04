<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { dashboard as adminDashboard } from '@/routes/admin';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import { destroy as destroyUser } from '@/actions/App/Http/Controllers/Admin/UserController';
import { ref, watch } from 'vue';

type AdminUser = {
    id: number;
    name: string;
    email: string;
    role: string;
    created_at: string | null;
};

const props = defineProps<{
    users: AdminUser[];
}>();

const users = ref<AdminUser[]>([...props.users]);

watch(
    () => props.users,
    (value) => {
        users.value = [...value];
    },
);

const deletingIds = ref<number[]>([]);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Administration',
        href: adminDashboard().url,
    },
];

const formatDate = (value: string | null): string => {
    if (! value) {
        return '—';
    }

    return new Intl.DateTimeFormat('fr-FR', {
        dateStyle: 'medium',
    }).format(new Date(value));
};

const csrfToken =
    document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content ?? '';

const isDeleting = (id: number): boolean => deletingIds.value.includes(id);

const stopDeleting = (id: number): void => {
    deletingIds.value = deletingIds.value.filter((currentId) => currentId !== id);
};

const requestDeleteUser = async (userId: number): Promise<void> => {
    if (! window.confirm('Confirmez-vous la suppression de ce compte utilisateur ?')) {
        return;
    }

    deletingIds.value = [...deletingIds.value, userId];

    try {
        const request = destroyUser(userId);
        const response = await fetch(request.url, {
            method: request.method.toUpperCase(),
            headers: {
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': csrfToken,
            },
        });

        if (! response.ok) {
            const body = await response.json().catch(() => null);
            throw new Error(body?.message ?? 'Suppression impossible pour le moment.');
        }

        users.value = users.value.filter((user) => user.id !== userId);
    } catch (error) {
        window.alert(error instanceof Error ? error.message : 'Une erreur est survenue.');
    } finally {
        stopDeleting(userId);
    }
};
</script>

<template>
    <Head title="Tableau de bord admin" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex flex-col gap-6 rounded-xl border border-sidebar-border/70 p-6 dark:border-sidebar-border">
            <div>
                <p class="text-sm font-medium text-muted-foreground">
                    Zone réservée aux administrateurs
                </p>
                <h1 class="text-2xl font-semibold">Tableau de bord</h1>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                <div class="rounded-xl border border-sidebar-border/70 bg-card p-4 dark:border-sidebar-border">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">
                        Accès rapides
                    </h2>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Ajoutez ici vos cartes et indicateurs critiques pour piloter l’application.
                    </p>
                </div>
                <div class="rounded-xl border border-sidebar-border/70 bg-card p-4 dark:border-sidebar-border">
                    <h2 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">
                        Sécurité
                    </h2>
                    <p class="mt-2 text-sm text-muted-foreground">
                        Présentez l’état des connexions sensibles, du 2FA et des journaux d’audit.
                    </p>
                </div>
            </div>

            <div class="rounded-xl border border-sidebar-border/70 bg-card p-4 dark:border-sidebar-border">
                <div class="flex items-center justify-between gap-2">
                    <div>
                        <h2 class="text-sm font-semibold uppercase tracking-wide text-muted-foreground">
                            Utilisateurs
                        </h2>
                        <p class="text-sm text-muted-foreground">
                            Comptes enregistrés avec le rôle utilisateur.
                        </p>
                    </div>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full text-left text-sm">
                        <thead class="text-xs uppercase text-muted-foreground">
                            <tr class="border-b border-sidebar-border/70 dark:border-sidebar-border">
                                <th class="px-2 py-2 font-medium">Nom</th>
                                <th class="px-2 py-2 font-medium">Email</th>
                                <th class="px-2 py-2 font-medium">Inscription</th>
                                <th class="px-2 py-2 text-right font-medium">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="user in users"
                                :key="user.id"
                                class="border-b border-sidebar-border/40 last:border-b-0 dark:border-sidebar-border/70"
                            >
                                <td class="px-2 py-3 font-medium text-foreground">
                                    {{ user.name }}
                                </td>
                                <td class="px-2 py-3 text-muted-foreground">
                                    {{ user.email }}
                                </td>
                                <td class="px-2 py-3 text-muted-foreground">
                                    {{ formatDate(user.created_at) }}
                                </td>
                                <td class="px-2 py-3 text-right">
                                    <button
                                        type="button"
                                    class="rounded-md border border-destructive/50 px-3 py-1.5 text-sm font-medium text-destructive transition hover:bg-destructive/10 disabled:opacity-60 dark:border-destructive"
                                        :disabled="isDeleting(user.id)"
                                        @click="requestDeleteUser(user.id)"
                                    >
                                        <span v-if="isDeleting(user.id)">Suppression…</span>
                                        <span v-else>Supprimer</span>
                                    </button>
                                </td>
                            </tr>
                            <tr v-if="users.length === 0">
                                <td class="px-2 py-6 text-center text-muted-foreground" colspan="4">
                                    Aucun utilisateur avec ce rôle pour le moment.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

