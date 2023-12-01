import Authenticated from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import MainTodoList from "./components/MainTodoList";

const Index = ({ auth,todoListItem }) => {
    console.log(auth,todoListItem);
    return (
        <Authenticated user={auth.user}>
            <Head title="Todo List" />
            <MainTodoList list={todoListItem} />
        </Authenticated>
    );
};

export default Index;
