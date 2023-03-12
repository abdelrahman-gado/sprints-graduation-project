import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/app/environment/environment';

@Injectable({
  providedIn: 'root',
})
export class ProductService {
  constructor(private httpClient: HttpClient) { }


  getShopProducts(page: string, colors: string[] | string, categories: string[] | string, price: number) {
    let path = `products?page=${page}&`;
    if (colors && Array.isArray(colors)) {
      path += colors.map((item) => "color[]=" + item).join("&");
    } else if (typeof (colors) === "string" && colors.length > 0) {
      path += "color[]=" + colors + "&";
    }

    if (categories && Array.isArray(categories)) {
      path += categories.map((item) => 'category[]=' + item).join('&');
    } else if (typeof (categories) === 'string' && categories.length > 0) {
      path += "category[]=" + categories + "&";
    }

    if (price > 0) {
      path += "&price=" + price;
    }
      
    return this.httpClient.get(`${environment.apiUrl}${path}`);
  }
  
  getNewArrivals() {
    return this.httpClient.get(`${environment.apiUrl}products/new-arrivals`)
  }

  getRecommended() {
    return this.httpClient.get(`${environment.apiUrl}products/recommended`)
  }

  getTrending() {
    return this.httpClient.get(`${environment.apiUrl}products/trending`)
  }

  getProducts() {
    return this.httpClient.get(`${environment.apiUrl}products`)
  }
  
  getAllProducts() {
    return this.httpClient.get(`${environment.apiUrl}products/all`)
  }
  
  getProductsById(id:number) {
    return this.httpClient.get(`${environment.apiUrl}products/${id}`)
  }
  getProductByCategoryId(category_id:number){
    return this.httpClient.get(`${environment.apiUrl}categories/${category_id}/products`)
  }
}
