import { Component, OnInit, Injector } from '@angular/core';
import { SettingsService } from '../../../core/settings/settings.service';
import { UntypedFormGroup, UntypedFormBuilder, Validators } from '@angular/forms';
import { Router } from '@angular/router';

@Component({
    selector: 'app-lock',
    templateUrl: './lock.component.html',
    styleUrls: ['./lock.component.scss'],
    standalone: false
})
export class LockComponent implements OnInit {

    valForm: UntypedFormGroup;
    router: Router;

    constructor(public settings: SettingsService, fb: UntypedFormBuilder, public injector: Injector) {

        this.valForm = fb.group({
            'password': [null, Validators.required]
        });

    }

    submitForm($ev, value: any) {
        $ev.preventDefault();
        for (let c in this.valForm.controls) {
            this.valForm.controls[c].markAsTouched();
        }
        if (this.valForm.valid) {
            console.log('Valid!');
            console.log(value);
            this.router.navigate(['home']);
        }
    }

    ngOnInit() {
        this.router = this.injector.get(Router);
    }

}
