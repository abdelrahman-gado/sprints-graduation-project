import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Category } from 'src/app/interface/category';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { CategoryService } from 'src/app/service/category/category.service';

@Component({
  selector: 'app-admin-categories',
  templateUrl: './admin-categories.component.html',
  styleUrls: ['./admin-categories.component.css'],
})
export class AdminCategoriesComponent implements OnInit {
  categories: Category[] = [];
  id: number = 0;

  constructor(
    private categoryService: CategoryService,
    private route: ActivatedRoute,
    private auth: AuthenticationService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.categoryService.getCategories().subscribe((data: any) => {
      this.categories = data.data;
      this.route.params.subscribe((params) => (this.id = params['id']));
    });
    //this.categories = this.categoryService.getCategories()
  }

  destroy(id:number) {
    this.auth
      .categoryDestroy(id)
      .subscribe((data: any) => console.log(data));
    this.router.navigate(['/admin-categories']);
  }
}
