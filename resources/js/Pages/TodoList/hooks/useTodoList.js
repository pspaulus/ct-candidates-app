import { useForm, router } from "@inertiajs/react";
import { useEffect, useState } from "react";

const useTodoList = ({ list }) => {
    const { data, setData, post, processing, reset, errors } = useForm({
        id: 0,
        title: "",
        state: false,
    });

    const [listTask, setLisTask] = useState(list);
    const [order, setOrder] = useState(true);

    const handleChangeOrder = () => {
        setOrder(!order);
        if (!order) {
            sortAsc();
            return;
        }
        sortDesc();
    };

    const addTask = (e) => {
        e.preventDefault();
        post(route("todolist.store"), { onSuccess: () => reset() });
    };

    const deleteTask = (id) => {
        router.visit(`todolist/${id}`, {
            method: "delete",
            data: { id },
        });
    };

    const toggleCompleted = async ({ id, state }) => {
        const dataSend = { id, state, title: "" };
        router.visit("todolist/update", {
            method: "put",
            data: dataSend,
        });
    };

    const filterTask = (e) => {
        const text = String(e.target.value).toLowerCase();
        const newListTask = list.filter((f) =>
            String(f.title).toLowerCase().includes(text)
        );
        setLisTask(newListTask);
    };

    const sortAsc = () => {
        const listSortAsc = list
            .slice()
            .sort((a, b) => a.title.localeCompare(b.title));
        setLisTask(listSortAsc);
        // console.log(ascendente);
    };

    const sortDesc = () => {
        const listSortDesc = list
            .slice()
            .sort((a, b) => b.title.localeCompare(a.title));
        setLisTask(listSortDesc);
    };

    useEffect(() => setLisTask(list), [list]);

    return {
        data,
        order,
        listTask,
        processing,
        errors,
        setData,
        addTask,
        deleteTask,
        toggleCompleted,
        filterTask,
        sortAsc,
        sortDesc,
        handleChangeOrder,
    };
};

export default useTodoList;
