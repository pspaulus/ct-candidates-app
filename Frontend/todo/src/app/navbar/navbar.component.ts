import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: ['./navbar.component.css']
})
export class NavbarComponent implements OnInit {
  username!: string;
  
  constructor(private router: Router){}
  ngOnInit(): void {
    const storedUsername = localStorage.getItem('username');
    if (storedUsername !== null) {
        this.username = storedUsername;
    } else {
        this.username = 'Nombre de Usuario Predeterminado';
    }
  }

  logout() {
    localStorage.removeItem('authToken');
    localStorage.removeItem('user_id');
    localStorage.removeItem('username');
    this.router.navigate(['/login']);
  }
}
