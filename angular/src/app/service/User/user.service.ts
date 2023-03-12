import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/app/environment/environment';

@Injectable({
  providedIn: 'root'
})
export class UserService {

  constructor(private httpClient:HttpClient) { }

  getUsers(){
   return this.httpClient.get(`${environment.apiUrl}users`)
  }
  getUsersById(id:number){
   return this.httpClient.get(`${environment.apiUrl}admin/users/${id}`)
  }
}
