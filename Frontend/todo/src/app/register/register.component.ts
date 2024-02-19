import { Component } from '@angular/core';
import { AuthService } from '../auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-register',
  templateUrl: './register.component.html',
  styleUrls: ['./register.component.css']
})
export class RegisterComponent {
  name = '';
  email = '';
  password = '';
  passwordConfirmation = '';

  constructor(private authService: AuthService, private router: Router) { }

  onRegister(): void {

    if(this.password === this.passwordConfirmation){
      const registerData = {
        name: this.name,
        email: this.email,
        password: this.password
      };
      this.authService.register(registerData).subscribe({
        next: (response) => {
          this.router.navigate(['/login']);
        },
        error: (error) => {
          console.log("error al registrar usuario")
          console.log("pass: "+this.password + "sd: "+ this.passwordConfirmation)
        }
      });

    }


    // Aquí llamarías al método del servicio para enviar los datos
    // Por ejemplo:

  }
}
