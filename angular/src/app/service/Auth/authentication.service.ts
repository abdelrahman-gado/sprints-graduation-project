import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/app/environment/environment';

@Injectable({
  providedIn: 'root',
})
export class AuthenticationService {
  constructor(private http: HttpClient) {}

  register(name: string, email: string, password: string) {
    const data = {
      name: name,
      email: email,
      password: password,
    };
    return this.http.post(`${environment.apiUrl}auth/register`, data);
  }
 userUpdate(formData:any,id:number){
return this.http.post(`${environment.apiUrl}users/${id}?_method=PUT`,formData)
  }
  userDestroy(id:number){
    return this.http.delete(`${environment.apiUrl}users/${id}`)
  }

  categoryCreate(formData:any,id:number){
  return this.http.post(`${environment.apiUrl}admin/categories`,formData)
  }
  categoryUpdate(formData:any,id:number){
return this.http.post(`${environment.apiUrl}admin/categories/${id}?_method=PUT`,formData)
  }
  categoryDestroy(id:number){
    return this.http.delete(`${environment.apiUrl}admin/categories/${id}`)
  }


  productCreate(formData:any){
return this.http.post(`${environment.apiUrl}admin/products`,formData)
  }
  productUpdate(formData:any,id:number){
return this.http.post(`${environment.apiUrl}admin/products/${id}?_method=PUT`,formData)
  }
  productDestroy(id:number){
return this.http.delete(`${environment.apiUrl}admin/products/${id}`)
  }

 
}
