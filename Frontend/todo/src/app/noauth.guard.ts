import { ActivatedRouteSnapshot, CanActivateFn, Router, RouterStateSnapshot, UrlTree } from '@angular/router';
import { AuthService } from './auth.service';
import { inject } from '@angular/core';
import { Observable } from 'rxjs';

// export const noauthGuard: CanActivateFn = (route, state) => {
//   return true;
// };
export const noauthGuard: CanActivateFn = (next: ActivatedRouteSnapshot, state: RouterStateSnapshot): Observable<boolean | UrlTree> | Promise<boolean | UrlTree> | boolean | UrlTree => {
  const router = inject(Router)
  const autentication = inject(AuthService);
  debugger;
  if (autentication.isLoggedIn()){
    router.navigate(['/tasks']);
      return false;
  }
  else {
      return true
  }
};