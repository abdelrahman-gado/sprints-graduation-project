import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminProductShowComponent } from './admin-product-show.component';

describe('AdminProductShowComponent', () => {
  let component: AdminProductShowComponent;
  let fixture: ComponentFixture<AdminProductShowComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdminProductShowComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AdminProductShowComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
