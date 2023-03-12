import { HttpClient } from '@angular/common/http';
import { Component, OnInit } from '@angular/core';
import { NgForm } from '@angular/forms';
import { environment } from 'src/app/environment/environment';
import { Category } from 'src/app/interface/category';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { CategoryService } from 'src/app/service/category/category.service';

@Component({
  selector: 'app-header',
  templateUrl: './header.component.html',
  styleUrls: ['./header.component.css'],
})
export class HeaderComponent implements OnInit {
  categories: Category[] = [];
  constructor(
    private categoryService: CategoryService,
    private auth: AuthenticationService,
    private http: HttpClient
  ) {}

ngOnInit(): void {
    this.categoryService.getCategories().subscribe((data:any)=>{this.categories=data.data})
}
  onRegister(form: NgForm) {
    const name = form.value.name;
    const email = form.value.email;
    const password = form.value.password;
    // console.log(form.value);
    this.auth.register(name, email, password).subscribe(
      (res) => {
        console.log(res);
      },
      (err) => {
        console.log(err);
      }
    );
  }

  onSignin(form: NgForm) {
    const email = form.value.email;
    const password = form.value.password;
    const data = {
      email: email,
      password: password,
    };

    console.log(data);

    this.http.post(`${environment.apiUrl}auth/login`, data).subscribe(
      (res) => {
        console.log(res);
      },
      (err) => {
        console.log(err);
      }
    );
  }
}
