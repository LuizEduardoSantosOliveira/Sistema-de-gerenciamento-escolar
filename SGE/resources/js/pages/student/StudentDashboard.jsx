import AuthenticatedLayout from '@/layouts/AuthenticatedLayoutUser';
import { Head } from '@inertiajs/react';

export default function StudentDashboard() {
    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Home
                </h2>
            }
        >
            <Head title="home" />

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                           Home do estudante
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
