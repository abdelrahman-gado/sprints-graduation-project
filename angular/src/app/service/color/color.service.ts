import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from 'src/app/environment/environment';

@Injectable({
  providedIn: 'root',
})
export class ColorService {
  constructor(private httpClient: HttpClient) { }
  
  getColors() {
    return this.httpClient.get(`${environment.apiUrl}colors`);
  }
}
