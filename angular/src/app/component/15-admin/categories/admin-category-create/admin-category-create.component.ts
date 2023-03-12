import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Category } from 'src/app/interface/category';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { CategoryService } from 'src/app/service/category/category.service';

@Component({
  selector: 'app-admin-category-create',
  templateUrl: './admin-category-create.component.html',
  styleUrls: ['./admin-category-create.component.css']
})
export class AdminCategoryCreateComponent implements OnInit {
  id: number = 0;
  category: Category = {} as Category;


  constructor(
    private route: ActivatedRoute,
    private categoryService: CategoryService,
    private auth: AuthenticationService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.route.params.subscribe((params) => (this.id = params['id']));
    this.categoryService
      .getCategoryById(this.id)
      .subscribe((data: any) => (this.category = data));
  }

  updateForm = new FormData
  name: string=''
  image: any 

  getName(name:string){
    this.name = name
  }

  getImage(event:any){
this.image = event.target.files[0]
console.log('file',this.image)
  }

  create() {
    
    this.updateForm.set('name',this.name)
    this.updateForm.set('image',this.image)
    this.auth.categoryCreate(this.updateForm,this.id).subscribe((data:any)=>console.log(data))
    this.router.navigate(['admin-categories']);
  }
}