import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, Validators } from '@angular/forms';
import { ActivatedRoute, Router } from '@angular/router';
import { Product } from 'src/app/interface/product';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { ProductService } from 'src/app/service/product/product.service';

@Component({
  selector: 'app-admin-product-edit',
  templateUrl: './admin-product-edit.component.html',
  styleUrls: ['./admin-product-edit.component.css']
})
export class AdminProductEditComponent implements OnInit{
  id: number = 0;
  product: Product = {} as Product;


  constructor(
    private route: ActivatedRoute,
    private productService: ProductService,
    private auth: AuthenticationService,
    private router: Router
  ) {}

  ngOnInit(): void {
    this.route.params.subscribe((params) => (this.id = params['id']));
    this.productService
      .getProductsById(this.id)
      .subscribe((data: any) => (this.product = data));
  }

  updateForm= new FormData()

  name:string =''
  image:string=''
  price:string=''
  description:string=''
  discount:string=''
  category_id:string=''
  color_id:string=''

  getName(name:string){
    this.name=name
  }
  getImage(event:any){
    this.image=event.target.files[0]
  }
  getPrice(price:string){
    this.price=price
  }
  getDescription(description:string){
    this.description=description
  }
  getDiscount(discount:string){
    this.discount=discount
  }
  getCategory(category_id:string){
    this.category_id=category_id
  }
  getColor(color_id:string){
    this.color_id=color_id
  }

  update() {
    this.updateForm.set('name',this.name)
    this.updateForm.set('image',this.image)
    this.updateForm.set('price',this.price)
    this.updateForm.set('description',this.description)
    this.updateForm.set('discount',this.discount)
    this.updateForm.set('category_id',this.category_id)
    this.updateForm.set('color_id',this.color_id)

      this.auth.productUpdate(this.updateForm, this.id)
        .subscribe((data: any) => console.log(data));
    
    this.router.navigate(['admin-products']);
  }
}
