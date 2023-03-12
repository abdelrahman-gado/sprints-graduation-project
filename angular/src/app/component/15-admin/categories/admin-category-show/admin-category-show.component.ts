import { Component, OnInit } from '@angular/core';
import { ActivatedRoute } from '@angular/router';
import { Category } from 'src/app/interface/category';
import { CategoryService } from 'src/app/service/category/category.service';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-admin-category-show',
  templateUrl: './admin-category-show.component.html',
  styleUrls: ['./admin-category-show.component.css']
})
export class AdminCategoryShowComponent implements OnInit {
  category: Category = {} as Category
  id: number = 0
  constructor(private route:ActivatedRoute, private categoryService:CategoryService){}

  ngOnInit(): void {
      this.route.params.subscribe(params=>this.id=params['id'])
      this.categoryService.getCategoryById(this.id).subscribe((data:any)=>this.category = data)

  }

}
