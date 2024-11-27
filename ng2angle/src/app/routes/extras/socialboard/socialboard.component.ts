import { Component, OnInit } from '@angular/core';

@Component({
    selector: 'app-socialboard',
    templateUrl: './socialboard.component.html',
    styleUrls: ['./socialboard.component.scss'],
    standalone: false
})
export class SocialboardComponent implements OnInit {

    following;

    constructor() { }

    ngOnInit() {
    }

}
