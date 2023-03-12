import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { User } from 'src/app/interface/user';
import { AuthenticationService } from 'src/app/service/Auth/authentication.service';
import { UserService } from 'src/app/service/User/user.service';

@Component({
  selector: 'app-admin-user-update',
  templateUrl: './admin-user-update.component.html',
  styleUrls: ['./admin-user-update.component.css']
})
export class AdminUserUpdateComponent implements OnInit{
id: number = 0
user: User = {} as User
constructor(private route:ActivatedRoute,private userService:UserService,private auth: AuthenticationService,
    private router: Router){}

ngOnInit(): void {
    this.route.params.subscribe(params=>this.id=params['id'])
    this.userService.getUsersById(this.id).subscribe((data:any)=>this.user=data)
}

  updateForm = new FormData
  
  address_info: string=''
  phone: string='' 

  
  getAddress(address_info:string){
    this.address_info = address_info
  }
  getPhone(phone:string){
    this.phone = phone
  }

  update() {
    
    this.updateForm.set('address_info',this.address_info)
    this.updateForm.set('phone',this.phone)
    
    this.auth.userUpdate(this.updateForm,this.id).subscribe((data:any)=>console.log(data))
    this.router.navigate(['admin-users']);
  }
}
