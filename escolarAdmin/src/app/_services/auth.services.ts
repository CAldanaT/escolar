import { Injectable, OnDestroy } from "@angular/core";
import { BehaviorSubject, Observable, Subscription } from "rxjs";
import { UserModel } from "../_modules/user.model";
import { HttpClient } from "@angular/common/http";
import { Router } from "express";

@Injectable({
    providedIn: "root",
})

export class AuthService implements OnDestroy{

    //private fields
    private unsubscribe: Subscription[] = [];

    //public fields
    currentUser$?: Observable<UserModel>;
    isLoading$: Observable<boolean> | undefined;
    currentUserSubject?: BehaviorSubject<UserModel>;
    isLoadingSubject: BehaviorSubject<boolean> | undefined;

    get currentUserValue(): UserModel {
        return this.currentUserSubject?.value ?? new UserModel();
    }
    
    set currentUserValue(user: UserModel) {
       this.currentUserSubject?.next(user);
    }

    user: any;
    token!: string;

    constructor(private http: HttpClient, private router: Router){
        this.isLoadingSubject = new BehaviorSubject<boolean>(false);
        //this.currentUserSubject = new BehaviorSubject<UserModel>(undefined);

    }

    ngOnDestroy(): void {
        throw new Error("Method not implemented.");
    }
    
}