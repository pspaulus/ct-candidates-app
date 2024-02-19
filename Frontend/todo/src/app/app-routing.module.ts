import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { LoginComponent } from './login/login.component';
import { RegisterComponent } from './register/register.component';
import { TaskComponent } from './task/task.component';
import { CreatetaskComponent } from './createtask/createtask.component';
import { AuthGuard } from './auth.guard';
import { noauthGuard } from './noauth.guard';

const routes: Routes = [
  { path: 'tasks', component: TaskComponent, canActivate: [AuthGuard]},
  { path: 'login', component: LoginComponent, canActivate: [noauthGuard] },
  { path: 'register', component: RegisterComponent, canActivate: [noauthGuard] },
  { path: 'tasksRegister', component: CreatetaskComponent, canActivate: [AuthGuard] },
  { path: '', redirectTo: '/tasks', pathMatch: 'full' }, 
  { path: '**', redirectTo: '/tasks' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
