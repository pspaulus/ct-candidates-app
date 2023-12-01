import Checkbox from "@/Components/Checkbox";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import useTodoList from "../hooks/useTodoList";
import TaskItem from "./TaskItem";

const MainTodoList = ({ list }) => {
    const {
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
    } = useTodoList({ list });
    return (
        <div className="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
            <div className="bg-white p-8 rounded shadow-md mt-4 p-2">
                <div>
                    <h1 className="text-3xl font-bold mb-4">📝Todo List</h1>
                </div>
                <form onSubmit={addTask}>
                    <div className="p-1 flex flex-col md:flex-row items-center">
                        <TextInput
                            type="text"
                            className="flex-grow p-2 border rounded"
                            placeholder="Nueva Tarea"
                            value={data.title}
                            autoFocus
                            required
                            onChange={(e) => setData("title", e.target.value)}
                        />
                        <div className="flex items-center mt-2 md:mt-0">
                            <PrimaryButton
                                className="mx-2 p-2 bg-grey-500 text-white rounded"
                                disabled={processing}
                            >
                                Agregar
                            </PrimaryButton>
                        </div>

                        <InputError message={errors.title} className="mt-2" />
                    </div>
                </form>
                <div className="p-1 flex flex-col md:flex-row items-center">
                    <TextInput
                        type="text"
                        className="flex-grow p-2 border rounded"
                        placeholder="Buscar Tarea"
                        onChange={(e) => filterTask(e)}
                    />
                    <div className="flex items-center mt-2 md:mt-0">
                        <button
                            className="mx-2 p-2 bg-grey-500 rounded"
                            onClick={handleChangeOrder}
                        >
                            {order ? "Asc ⬆️" : "Desc ⬇️"}
                        </button>
                    </div>
                </div>

                {listTask.length > 0 ? (
                    <ul className="space-y-2">
                        {listTask.map((task) => (
                            <TaskItem
                                key={task.id}
                                task={task}
                                func={{ toggleCompleted, deleteTask }}
                            />
                        ))}
                    </ul>
                ) : (
                    <div className="text-center mt-4 p-1 bg-red-100 text-red-600 border border-red-300 rounded">
                        😊 Sin Tareas
                    </div>
                )}
            </div>
        </div>
    );
};

export default MainTodoList;
