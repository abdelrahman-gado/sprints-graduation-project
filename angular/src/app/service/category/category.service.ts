import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { environment } from 'src/app/environment/environment';
import { Category } from 'src/app/interface/category';

@Injectable({
  providedIn: 'root'
})
export class CategoryService {

  constructor(private httpClient:HttpClient) { }

  getCategories():any{
     return this.httpClient.get(`${environment.apiUrl}categories`)
     //let cat:Category[] = [{id:1,name:"aa",image:"haw"},{id:2,name:"aa",image:"haw"},{id:3,name:"aa",image:"haw"}]
     //return cat
  }

  getCategoryById(id:number){
    return this.httpClient.get(`${environment.apiUrl}categories/${id}`)
  }
}
