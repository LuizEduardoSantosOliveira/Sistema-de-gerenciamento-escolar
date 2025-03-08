import { Head, useForm } from '@inertiajs/react';

export default function UserManagement() {
    const { data, setData, post, processing, errors } = useForm({
        name: '',
        email: '',
        password: '',
        role: '', // or role could be stored as boolean flags if multiple roles are possible
    });

    function handleSubmit(e) {
        e.preventDefault();
        post(route('users.store')); // This should point to your Laravel route
    }

    return (
        <>
            <Head title="Gerencimaento de usuário" />
            
            <h1>Cadastro de usuário</h1>
            
            <form onSubmit={handleSubmit}>
                <div>
                    <label htmlFor="name">Nome</label>
                    <input 
                        id="name"
                        type="text" 
                        value={data.name} 
                        onChange={e => setData('name', e.target.value)}
                    />
                    {errors.name && <div>{errors.name}</div>}
                </div>
                
                <div>
                    <label htmlFor="email">Email</label>
                    <input 
                        id="email"
                        type="email" 
                        value={data.email} 
                        onChange={e => setData('email', e.target.value)}
                    />
                    {errors.email && <div>{errors.email}</div>}
                </div>
                
                <div>
                    <label htmlFor="password">Senha</label>
                    <input 
                        id="password"
                        type="password" 
                        value={data.password} 
                        onChange={e => setData('password', e.target.value)}
                    />
                    {errors.password && <div>{errors.password}</div>}
                </div>
                
                <div>
                    <label>
                        <input 
                            type="radio" 
                            name="role" 
                            value="student" 
                            onChange={e => setData('role', e.target.value)}
                        />
                        Estudante
                    </label>
                    
                    <label>
                        <input 
                            type="radio" 
                            name="role" 
                            value="teacher" 
                            onChange={e => setData('role', e.target.value)}
                        />
                        Professor
                    </label>
                    
                    <label>
                        <input 
                            type="radio" 
                            name="role" 
                            value="admin" 
                            onChange={e => setData('role', e.target.value)}
                        />
                        Admin
                    </label>
                    {errors.role && <div>{errors.role}</div>}
                </div>
                
                <button type="submit" disabled={processing}>Enviar</button>
            </form>
        </>
    );
}