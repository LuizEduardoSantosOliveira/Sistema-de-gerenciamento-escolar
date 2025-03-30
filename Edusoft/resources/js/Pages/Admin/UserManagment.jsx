import React from 'react';
import AuthenticatedLayoutAdmin from '@/Layouts/AuthenticatedLayoutAdmin';
import { Head, Link, useForm, usePage } from '@inertiajs/react';
import { Toaster, toast } from 'sonner'; // Recommended for toast notifications

export default function UserManagement() {
    const { users } = usePage().props;
    const { delete: destroy } = useForm(); // Destructure delete method from useForm
    const getUserTypeLabel = (userType) => {
        const userTypeMap = {
            'student': 'Aluno',
            'teacher': 'Professor',
            'admin': 'Administrador'
        };
    
        return userTypeMap[userType] || userType;
    };

    const handleUserDelete = (userId) => {
        // Show a confirmation toast/alert
        toast.warning('Confirmar Exclusão', {
            description: 'Tem certeza que deseja excluir este usuário?',
            cancel: {
                label: 'Cancelar',
            },
            action: {
                label: 'Confirmar',
                onClick: () => {
                    destroy(route('users.destroy', { user: userId }), {
                        onSuccess: () => {
                            toast.success('Usuário excluído com sucesso!');
                        },
                        onError: () => {
                            toast.error('Erro ao excluir usuário');
                        }
                    });
                },
            },
        });
    };

    return (
        <AuthenticatedLayoutAdmin
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Gerenciamento de Usuários
                </h2>
            }
        >
            <Toaster position="top-right" richColors />
            <Head title="Gerenciamento de Usuário" />

            <div className="py-12">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="mb-4">
                        <Link 
                            href={route('users.create')} 
                            className="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600"
                        >
                            Novo usuário
                        </Link>
                    </div>

                    <table className="w-full border-collapse">
                        <thead>
                            <tr className="bg-gray-200">
                                <th className="border p-2">ID</th>
                                <th className="border p-2">Nome</th>
                                <th className="border p-2">Email</th>
                                <th className="border p-2">Criado em</th>
                                <th className="border p-2">Tipo de usuário</th>
                                <th className="border p-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            {users.map((user) => (
                                <tr key={user.id} className="hover:bg-gray-100">
                                    <td className="border p-2">{user.id}</td>
                                    <td className="border p-2">{user.name}</td>
                                    <td className="border p-2">{user.email}</td>
                                    <td className="border p-2">{user.created_at}</td>
                                    <td className="border p-2">{getUserTypeLabel(user.user_type)}</td>
                                    <td className="border p-2 text-center">
                                        <div className="flex space-x-2 justify-center">
                                            <Link 
                                                href={route('users.edit', { user: user.id })}
                                                className="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600"
                                            >
                                                Editar
                                            </Link>
                                            <button 
                                                onClick={() => handleUserDelete(user.id)}
                                                className="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"
                                            >
                                                Excluir
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </div>
        </AuthenticatedLayoutAdmin>
    );
}