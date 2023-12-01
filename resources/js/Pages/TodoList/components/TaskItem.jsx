import Checkbox from "@/Components/Checkbox";

const TaskItem = ({ task, func }) => {
    return (
        <li key={task.id} className="flex items-center">
            <Checkbox
                className="mr-2"
                onChange={(e) =>
                    func.toggleCompleted({
                        id: task.id,
                        state: e.target.checked,
                    })
                }
                checked={task.state}
            />
            <span
                className={`flex-1 ${
                    task.state ? "line-through text-gray-500" : ""
                }`}
            >
                {task.title}
            </span>
            <button
                type="button"
                className="text-red-500 hover:text-red-700"
                onClick={() => func.deleteTask(task.id)}
            >
                ❌
            </button>
        </li>
    );
};

export default TaskItem;
