import React, { useEffect, useState } from 'react'
import { useNavigate } from 'react-router-dom';
import { TextField, Button, List, ListItem, Card,CardContent,ListItemText, Typography,Alert,Grid,Checkbox, ListItemSecondaryAction,  } from '@mui/material';
import axios from '../axios/axios'
const Tasks = () => {
    const [newTask, setNewTask] = useState('');
    const [messageError, setMessageError] = useState("")
    const [tasksUser, setTasksUser] = useState([])
    const navigate = useNavigate()


  const getTasks = async (e) => {
        await axios.get('/tasks')
        .then(response=>{
            setTasksUser(response.data.data)
        }).catch(error=>{
            setMessageError(error.response.data.message);
        })
  };
  console.log(tasksUser)
  const updateStatus = async(id,status)=>{
    axios.put(`/tasks/${id}`, {status})
    .then(response => {
        setTasksUser(tasksUser.map(task => task.id_task === id ? response.data.task : task));
    })
    .catch(error => {
        setMessageError('There was an error updating the task!', error);
    });
  }
  const postTasks = async (e) => {
    e.preventDefault();
    if (newTask.trim() !== '') {
        try {
            await axios.post('/tasks',{task:newTask});
            setNewTask('')
            getTasks()
        } catch (error) {
            setMessageError(error.response.data.message);
        }
    }
  };


    const handleTaskChange = (e) => {
        setNewTask(e.target.value);
    };

    const handleOrderChange = async(id,order)=>{
        axios.put(`/tasks/${id}`, {order})
        .then(response => {
            setTasksUser(tasksUser.map(task => task.id_task === id ? response.data.task : task));
        })
        .catch(error => {
            setMessageError('There was an error updating the task!', error);
        });
  }

  const deleteTask = (id) => {
    axios.delete(`/tasks/${id}`)
        .then(() => {
            setTasksUser(tasksUser.filter(task => task.id_task !== id));
            console.log('Task deleted successfully');
        })
        .catch(error => console.error('There was an error deleting the task!', error));
};

  tasksUser.sort((a, b) => {
    if (a.status === 2 && b.status !== 2) return 1;
    if (a.status !== 2 && b.status === 2) return -1;
    return a.order - b.order;
});




  useEffect(() => {
    getTasks()
  }, [])
  return (
    <Card>

    <CardContent>
        {messageError.length >0 &&  <Alert style={{marginBlock:'2px'}} severity="error">{messageError}</Alert>}
        <form onSubmit={postTasks}>
            <Grid container spacing={2} alignItems="center" style={{ marginTop: 10 }}>
                <Grid item xs={8}>
                    <TextField
                        label="Nueva Tarea"
                        variant="outlined"
                        fullWidth
                        value={newTask}
                        onChange={handleTaskChange}
                        style={{ marginBottom: '10px' }}
                        />
                </Grid>
                 <Grid item xs={4}>
                    <Button type="submit" variant="contained" color="primary">
                                Add Task
                    </Button>
                 </Grid>
            </Grid>
            </form>
            <Typography variant="h5" component="div">
                    Task List
                </Typography>
            <List>
                {tasksUser.map((task, index) => (
                  <ListItem style={task.status === 2?{backgroundColor:'#E3FDE4'} : null} key={index} dense>
                    <Checkbox
                      edge="start"
                      checked={task.status === 2}
                      indeterminate={task.status === 1}
                      tabIndex={-1}
                      disableRipple
                      onChange={() => updateStatus(task.id_task, task.status === 0   ? 1 :(task.status === 1? 2:0) )}
                  />
                  <ListItemText
                        
                      primary={task.title}
                      secondary={`Status: ${task.status === 2 ? 'Completed' : task.status === 1 ? 'In Progress' : 'Pending'} | Order: ${task.order}`}
                  />
                  <TextField
                      type="number"
                      label="Order"
                      disabled={task.status === 2}
                      value={task.order}
                      onChange={(e) => handleOrderChange(task.id_task, parseInt(e.target.value))}
                      style={{ marginRight: 20 }}
                  />
                  <Button style={{color:'red'}} onClick={()=>deleteTask(task.id_task)}>
                    <b>X</b> 
                  </Button>
                  
              </ListItem>
                ))}
            </List>
    </CardContent>
    </Card>

  )
}

export default Tasks