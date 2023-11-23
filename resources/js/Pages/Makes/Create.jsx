import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { useForm, Link, router } from "@inertiajs/react";
import Input from "@/Components/Input";
import Label from "@/Components/Label";
import { countries } from "@/utils/countries";
import Select from "react-select";
import { ArrowLeftCircleIcon } from "@heroicons/react/24/outline";
import { ToastContainer, toast } from "react-toastify";
import "react-toastify/dist/ReactToastify.css";

const MakesCreate = (props) => {
    const { data, setData, post, errors } = useForm({
        name: "",
        description: "",
        founding_year: "",
        country_of_origin: "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        post(route("marcas.store"), {
            onSuccess: () => {
                router.visit(route("marcas.index"));
            },
            onError: (error) => {
                Object.entries(error).forEach(([key, value]) => {
                    toast.error(value);
                });
            },
        });
    };

    const countryOptions = countries.map((country) => ({
        label: country.nome_pais,
        value: country.nome_pais,
    }));

    return (
        <AuthenticatedLayout
            title="Criar Marca"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Criar Marca
                    </h2>

                    <Link
                        href={route("marcas.index")}
                        className="flex items-center px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                    >
                        <ArrowLeftCircleIcon
                            aria-hidden="true"
                            className="w-6 h-6"
                        />
                        <span className="pl-2">Voltar</span>
                    </Link>
                </div>
            }
        >
            <ToastContainer />
            <div className="p-6 overflow-hidden bg-autoconf-lightblue rounded-md shadow-md dark:bg-dark-eval-1">
                <form onSubmit={handleSubmit}>
                    <div className="grid grid-cols-1 gap-4">
                        <Label forInput="name" value="Nome" />
                        <Input
                            name="name"
                            placeholder="Nome"
                            value={data.name}
                            required
                            isFocused
                            handleChange={(e) =>
                                setData("name", e.target.value)
                            }
                            error={errors.name}
                        />

                        <Label forInput="description" value="Descrição" />
                        <Input
                            name="description"
                            value={data.description}
                            placeholder="Descrição"
                            handleChange={(e) =>
                                setData("description", e.target.value)
                            }
                            error={errors.description}
                        />

                        <Label
                            forInput="founding_year"
                            value="Ano de Fundação"
                        />
                        <Input
                            name="founding_year"
                            placeholder="Ano de Fundação"
                            value={data.founding_year}
                            maxLength="4"
                            handleChange={(e) => {
                                const result = e.target.value.replace(
                                    /\D/g,
                                    ""
                                );
                                setData("founding_year", result);
                            }}
                            error={errors.founding_year}
                        />

                        <Label
                            forInput="country_of_origin"
                            value="País de Origem"
                        />
                        <Select
                            isClearable
                            menuPortalTarget={document.body}
                            menuPosition={"fixed"}
                            options={countryOptions}
                            value={countryOptions.find(
                                (option) =>
                                    option.value === data.country_of_origin
                            )}
                            onChange={(selectedOption) =>
                                setData(
                                    "country_of_origin",
                                    selectedOption ? selectedOption.value : ""
                                )
                            }
                            placeholder="Selecione"
                            className="py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-autoconf-blue focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1"
                        />
                    </div>

                    <div className="mt-4">
                        <button
                            type="submit"
                            className="px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                        >
                            Cadastrar
                        </button>
                    </div>
                </form>
            </div>
        </AuthenticatedLayout>
    );
};

export default MakesCreate;
