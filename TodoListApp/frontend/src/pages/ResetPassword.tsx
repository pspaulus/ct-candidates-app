import { FormEvent, useEffect, useState } from "react";
import Spinner from "../components/ui/Spinner";
import useAuthContext from "../hooks/useAuthContext";
import toast from "react-hot-toast";
import { useParams, useSearchParams } from "react-router-dom";

export default function ResetPassword() {
  const [email, setEmail] = useState<string | number>("");
  const [password, setPassword] = useState("");
  const [password_confirmation, setPasswordConfirmation] = useState("");
  const { newPassword, loading, errors, status } = useAuthContext();
  const { token } = useParams();
  const [searchParams] = useSearchParams();

  const handleSubmit = async (e: FormEvent) => {
    e.preventDefault();
    newPassword({ email, password, token, password_confirmation });
  };

  useEffect(() => {
    if (status) {
      toast.success(status);
    }

    setEmail(searchParams.get("email") || 0);
  }, [status, searchParams]);

  return (
    <div className="flex min-h-full flex-1 flex-col justify-center px-6 py-12 lg:px-8">
      <div className="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 className="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">
          Reset password
        </h2>
      </div>

      <div className="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form className="space-y-6" method="POST" onSubmit={handleSubmit}>
          <div>
            <label
              htmlFor="email"
              className="block text-sm font-medium leading-6 text-gray-900"
            >
              Correo electrónico
            </label>
            <div className="mt-2">
              <input
                id="email"
                name="email"
                type="email"
                autoComplete="email"
                className={`block w-full border-0 rounded-md py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ${
                  errors.email && "ring-red-500"
                }`}
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                readOnly
              />
            </div>
            {errors.email && (
              <span className="text-red-400 text-sm">{errors.email[0]}</span>
            )}
          </div>

          <div>
            <label
              htmlFor="password"
              className="block text-sm font-medium leading-6 text-gray-900"
            >
              New password
            </label>
            <div className="mt-2">
              <input
                id="password"
                name="password"
                type="password"
                autoComplete="current-password"
                className={`block w-full border-0 rounded-md py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ${
                  errors.password && "ring-red-500"
                }`}
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
            {errors.password && (
              <span className="text-red-400 text-sm">{errors.password[0]}</span>
            )}
          </div>

          <div>
            <label
              htmlFor="password_confirmation"
              className="block text-sm font-medium leading-6 text-gray-900"
            >
              Confirmar contraseña
            </label>
            <div className="mt-2">
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                autoComplete="current-password"
                className={`block w-full border-0 rounded-md py-1.5 px-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 ${
                  errors.password && "ring-red-500"
                }`}
                value={password_confirmation}
                onChange={(e) => setPasswordConfirmation(e.target.value)}
              />
            </div>
          </div>

          <div>
            <button
              type="submit"
              className="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 items-center gap-x-2 disabled:cursor-not-allowed"
              disabled={loading}
            >
              <Spinner loading={loading} />
              <span>{loading ? "Enviando enlace..." : "Enviar enlace"}</span>
            </button>
          </div>
        </form>
      </div>
    </div>
  );
}
