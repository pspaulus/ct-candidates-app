import { Component, OnInit } from '@angular/core';
import { TaskService } from '../task.service';
import { CdkDragDrop, moveItemInArray } from '@angular/cdk/drag-drop';
interface Task {
  id: Number;
  title: string;
  completed: boolean;
}
@Component({
  selector: 'app-task',
  templateUrl: './task.component.html',
  styleUrls: ['./task.component.css']
})
export class TaskComponent implements OnInit {
  taskTitle: string = '';
  tasks: Task[] = [];

  constructor(private taskService: TaskService){}

  ngOnInit(): void {
    this.loadTasks();
  }

  toggleCompleted(task: any): void {
    task.completed = !task.completed;
  }
  drop(event: CdkDragDrop<string[]>) {
    moveItemInArray(this.tasks, event.previousIndex, event.currentIndex);
  }

  deleteTask(taskToDelete: Task): void {
    this.tasks = this.tasks.filter(task => task !== taskToDelete);
    
    this.taskService.deleteTaskId(`${taskToDelete.id}`).subscribe({
      next: (data) => {
        // this.tasks = data;
      },
      error: (error) => {
        console.error('Error fetching tasks', error);
      }
    })
  }
  updateCompletedTask(task: Task){
    debugger
    this.toggleCompleted(task);
    this.taskService.updateTaskId(`${task.id}`, task.completed).subscribe({
      next: (data) => {
        // this.tasks = data;
      },
      error: (error) => {
        console.error('Error fetching tasks', error);
      }
    })
  }
  loadTasks(): void {
    debugger;
    this.taskService.getTasks().subscribe({
      next: (data) => {
        this.tasks = data;
      },
      error: (error) => {
        console.error('Error fetching tasks', error);
      }
    });
  }
  SearchTitle(){
    this.taskService.getTasksTitle(this.taskTitle).subscribe({
      next: (data) => {
        this.tasks = data;
      },
      error: (error) => {
        console.error('Error fetching tasks', error);
      }
    })
  }
}
