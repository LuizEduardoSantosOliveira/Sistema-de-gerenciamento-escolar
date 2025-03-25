import InputError from '@/Components/InputError';
import InputLabel from '@/Components/InputLabel';
import PrimaryButton from '@/Components/PrimaryButton';
import TextInput from '@/Components/TextInput';
import { Transition } from '@headlessui/react';
import { Link, useForm, usePage } from '@inertiajs/react';
import { Button } from '@headlessui/react';

export default function UserCreate() {
    const { data, setData, errors, post } = useForm({
        name: "",
        password: "",
        email: "",
        cep: "",
        cpf: "",
        telephone: "",
        user_type: ""
    });


    const submit = (e) => {
        e.preventDefault();

        console.log(data)

        post(route('users.store'));


    };
    return (

        <>
            <div>
                <Link href={route('users.index')}>voltar</Link>
            </div>

            <form onSubmit={submit} className="mt-6 space-y-6">
                <div>
                    <InputLabel htmlFor="name" value="Name" />

                    <TextInput
                        id="name"
                        className="mt-1 block w-full"
                        value={data.name}
                        onChange={(e) => setData('name', e.target.value)}
                        required
                        isFocused
                        autoComplete="name"

                    />

                    <InputError className="mt-2" message={errors.name} />
                </div>

                <div>
                    <InputLabel htmlFor="email" value="Email" />

                    <TextInput
                        id="email"
                        className="mt-1 block w-full"
                        value={data.email}
                        onChange={(e) => setData('email', e.target.value)}
                        required
                        autoComplete="email"

                    />

                    <InputError className="mt-2" message={errors.email} />
                </div>

                <div>
                    <InputLabel htmlFor="password" value="Password" />

                    <input
                        type="password"
                        id="Password"
                        placeholder='senha'
                        className="mt-1 block w-full"
                        value={data.password}
                        onChange={(e) => setData('password', e.target.value)}
                        required



                    />

                    <InputError className="mt-2" message={errors.password} />
                </div>

                <div>
                    <InputLabel htmlFor="cep" value="ep" />

                    <TextInput
                        id="cep"
                        className="mt-1 block w-full"
                        value={data.cep}
                        onChange={(e) => setData('cep', e.target.value)}
                        required
                        autoComplete="cep"

                    />

                    <InputError className="mt-2" message={errors.cep} />
                </div>

                <div>
                    <InputLabel htmlFor="cpf" value="Cpf" />

                    <TextInput
                        id="cpf"
                        classcpf="mt-1 block w-full"
                        value={data.cpf}
                        onChange={(e) => setData('cpf', e.target.value)}
                        required
                        autoComplete="cpf"

                    />

                    <InputError className="mt-2" message={errors.cpf} />
                </div>

                <div>
                    <InputLabel htmlFor="telephone" value="Telephone" />

                    <TextInput
                        id="Te"
                        className="mt-1 block w-full"
                        value={data.telephone}
                        onChange={(e) => setData('telephone', e.target.value)}
                        required
                        autoComplete="telephone"

                    />

                    <InputError className="mt-2" message={errors.telephone} />
                </div>

                <div>
                    <InputLabel htmlFor="user_type" value="tipo do usuário" />

                    <select
                        name="user_type"
                        id="user_type"
                        value={data.user_type}
                        onChange={(e) => setData('user_type', e.target.value)}
                    >
                        <option value="student">Estudante</option>
                        <option value="teacher">Professor</option>
                        <option value="admin">Admin</option>
                    </select>

                </div>

                <div>


                    <button type="submit">enviar</button>
                </div>
            </form>
        </>

    )
}