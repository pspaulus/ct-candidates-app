import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TaskService {


  private apiUrl = 'http://127.0.0.1:8000/api/tasks'; // Ajusta a tu URL de API

  constructor(private http: HttpClient) { }
  
  private getHeaders(): HttpHeaders {
    const token = localStorage.getItem('authToken');
    let headers = new HttpHeaders();
    if (token) {
      headers = headers.set('Authorization', `Bearer ${token}`);
    }
    return headers;
  }

  createTask(taskData: any) {
    debugger;
    const headers = this.getHeaders();
    return this.http.post(this.apiUrl, taskData, {headers});
  }
  getTasks(): Observable<any> {
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    });
    return this.http.get(this.apiUrl, { headers });
  }
  getTasksTitle(titleContent: string): Observable<any> {
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    });
    return this.http.get(`${this.apiUrl}?title=${titleContent}`, { headers });
  }
  deleteTaskId(id: string){
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    });
    return this.http.delete(`${this.apiUrl}/${id}`, { headers });
  }
  updateTaskId(id: string, isCompleted: boolean){
    const headers = new HttpHeaders({
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
      'Content-Type': 'application/json'
    });
    const body = {
      completed: isCompleted
    };
    return this.http.put(`${this.apiUrl}/${id}`,body, { headers });
  }
}
