import { Component } from '@angular/core';
import { FormBuilder, FormGroup } from '@angular/forms';
import { TaskService } from '../task.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-createtask',
  templateUrl: './createtask.component.html',
  styleUrls: ['./createtask.component.css']
})
export class CreatetaskComponent {
  taskForm!: FormGroup;

  constructor(private fb: FormBuilder, private taskService: TaskService, private router: Router) { }

  ngOnInit(): void {
    this.taskForm = this.fb.group({
      title: [''],
      order: [''],
      completed: [false],
      usercreate: [localStorage.getItem('user_id')], 
      userassigned: [localStorage.getItem('user_id')]
    });
  }

  saveAndExit(): void {
    if (this.taskForm.valid) {
      this.taskService.createTask(this.taskForm.value).subscribe({
        next: (response) => {
          console.log('Tarea guardada', response);
        },
        error: (error) => console.error('Error al guardar la tarea', error),
        complete: () =>{
          this.router.navigate(['/tasks']);
        }
      });
    }
  }

  saveAndNew(): void {
    this.saveTask();
    this.taskForm.reset({
      title: '',
      order: '',
      usercreate: localStorage.getItem('user_id'), 
      userassigned: localStorage.getItem('user_id'),
      completed: false
    });
  }

  private saveTask(): void {
    if (this.taskForm.valid) {
      this.taskService.createTask(this.taskForm.value).subscribe({
        next: (response) => {
          console.log('Tarea guardada', response);
        },
        error: (error) => console.error('Error al guardar la tarea', error)
      });
    }
  }
}
