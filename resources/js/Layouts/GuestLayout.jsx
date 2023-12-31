import ApplicationLogo from "@/Components/ApplicationLogo";
import { Link } from "@inertiajs/react";

export default function Guest({ children }) {
    return (
        <div className="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <Link href="/">
                    <ApplicationLogo
                        color="#0c54c4"
                        className="h-28 fill-current text-gray-500"
                    />
                    <p className="text-xl text-center mt-2">Teste</p>
                </Link>
            </div>

            <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-autoconf-lightblue shadow-md overflow-hidden sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
