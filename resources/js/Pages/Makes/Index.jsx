import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { PlusIcon } from "@heroicons/react/24/outline";
import { Link, router } from "@inertiajs/react";
import { useState } from "react";

const MakesIndex = (props) => {
    const handleDelete = (id) => {
        router.delete(route("marcas.destroy", id));
    };

    const handleSort = (column) => {
        const urlParams = new URLSearchParams(window.location.search);
        const direction =
            (urlParams.get("column") == column &&
                urlParams.get("direction") === "desc") ||
            urlParams.get("direction") === null
                ? "asc"
                : "desc";

        const url = route("marcas.index", {
            column,
            direction,
        });
        router.visit(url);
    };

    return (
        <AuthenticatedLayout
            title="Marcas"
            auth={props.auth}
            errors={props.errors}
            header={
                <div className="flex flex-col text-gray-800 gap-4 md:flex-row md:items-center md:justify-between dark:text-white">
                    <h2 className="text-xl font-semibold leading-tight">
                        Marcas
                    </h2>

                    <Link
                        href={route("marcas.create")}
                        className="flex items-center px-4 py-2 text-white bg-autoconf-blue rounded-md hover:bg-autoconf-darkblue"
                    >
                        <PlusIcon aria-hidden="true" className="w-6 h-6" />
                        <span className="pl-2">Adicionar</span>
                    </Link>
                </div>
            }
        >
            <div className="p-6 overflow-hidden bg-autoconf-lightblue rounded-md shadow-md dark:bg-dark-eval-1">
                <div className="overflow-x-auto">
                    <table className="min-w-full border rounded-md overflow-hidden">
                        <thead className="bg-gray-50 dark:bg-dark-eval-2">
                            <tr className="border-b ">
                                <th className="py-2 px-4 border-r">
                                    <button onClick={() => handleSort("name")}>
                                        Nome
                                    </button>
                                </th>
                                <th className="py-2 px-4 border-r">
                                    Descrição
                                </th>
                                <th className="py-2 px-4 border-r">
                                    <button
                                        onClick={() =>
                                            handleSort("founding_year")
                                        }
                                    >
                                        Ano de Fundação
                                    </button>
                                </th>
                                <th className="py-2 px-4 border-r">
                                    <button
                                        onClick={() =>
                                            handleSort("country_of_origin")
                                        }
                                    >
                                        País de Origem
                                    </button>
                                </th>
                                <th className="py-2 px-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody className="bg-gray-50 dark:bg-dark-eval-2 text-center">
                            {props.makes.data.map((make) => (
                                <tr key={make.id} className="border-b">
                                    <td className="py-2 px-4 border-r">
                                        {make.name}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {make.description}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {make.founding_year}
                                    </td>
                                    <td className="py-2 px-4 border-r">
                                        {make.country_of_origin}
                                    </td>
                                    <td className="py-2 px-4">
                                        <Link
                                            href={route("marcas.edit", make.id)}
                                            className="text-blue-600 hover:underline mr-2"
                                        >
                                            Editar
                                        </Link>
                                        <button
                                            onClick={() =>
                                                handleDelete(make.id)
                                            }
                                            className="text-red-600 hover:underline"
                                        >
                                            Deletar
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
                <div className="mt-4 text-center">
                    {props.makes.links.map((link, index) => (
                        <Link
                            key={index}
                            href={link.url}
                            className={`inline-block px-3 py-1 mr-2 ${
                                link.active
                                    ? "bg-autoconf-blue text-white"
                                    : "bg-gray-50 dark:bg-dark-eval-1"
                            }`}
                        >
                            {link.label === "&laquo; Anterior"
                                ? "<<"
                                : link.label === "Próximo &raquo;"
                                ? ">>"
                                : link.label}
                        </Link>
                    ))}
                </div>
            </div>
        </AuthenticatedLayout>
    );
};

export default MakesIndex;
