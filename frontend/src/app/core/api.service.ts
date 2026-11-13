import { Injectable,signal } from '@angular/core';
import { HttpClient,HttpParams } from '@angular/common/http';
import { Observable,tap } from 'rxjs';
import { Activity,Admin,Page,Student } from './models';
@Injectable({providedIn:'root'}) export class ApiService {
 readonly base= (globalThis as any).__API_URL__ || 'http://localhost:8000/api';
 readonly admin=signal<Admin|null>(null);
 constructor(private http:HttpClient){}
 login(email:string,password:string,keepSignedIn=true){return this.http.post<{token:string;admin:Admin}>(`${this.base}/login`,{email,password}).pipe(tap(r=>{localStorage.removeItem('northstar_token');sessionStorage.removeItem('northstar_token');(keepSignedIn?localStorage:sessionStorage).setItem('northstar_token',r.token);this.admin.set(r.admin)}));}
 me(){return this.http.get<Admin>(`${this.base}/me`).pipe(tap(a=>this.admin.set(a)));}
 logout(){return this.http.post(`${this.base}/logout`,{}).pipe(tap(()=>{localStorage.removeItem('northstar_token');this.admin.set(null)}));}
 students(q:Record<string,string|number>={}){let p=new HttpParams();Object.entries(q).forEach(([k,v])=>{if(v!==''&&v!==undefined)p=p.set(k,String(v));});return this.http.get<Page<Student>>(`${this.base}/students`,{params:p});}
 student(id:number){return this.http.get<Student>(`${this.base}/students/${id}`)}
 createStudent(data:Partial<Student>){return this.http.post<Student>(`${this.base}/students`,data)}
 updateStudent(id:number,data:Partial<Student>){return this.http.put<Student>(`${this.base}/students/${id}`,data)}
 deleteStudent(id:number){return this.http.delete(`${this.base}/students/${id}`)}
 dashboard(){return this.http.get<any>(`${this.base}/dashboard`)}
 activities(){return this.http.get<Page<Activity>>(`${this.base}/activities?per_page=100`)}
 updateProfile(data:Partial<Admin>&{notification_preferences?:boolean[]}){return this.http.put<Admin>(`${this.base}/profile`,data).pipe(tap(a=>this.admin.set(a)))}
 changePassword(current_password:string,password:string,password_confirmation:string){return this.http.put(`${this.base}/password`,{current_password,password,password_confirmation})}
}
