export interface Student { id:number; student_number:string; first_name:string; last_name:string; email:string; phone:string; course:string; year:string; status:'Active'|'Inactive'|'On leave'; gpa:number|null; joined:string; dob:string; gender:string; address:string; guardian:string; guardian_phone:string }
export interface Admin { id:number; name:string; email:string; phone:string|null; department:string|null; notification_preferences?:boolean[] }
export interface Activity { id:number; action:string; detail:string; kind:'add'|'edit'|'delete'|'security'; created_at:string }
export interface Page<T> { data:T[]; current_page:number; last_page:number; per_page:number; total:number }
export const emptyStudent:Partial<Student>={first_name:'',last_name:'',email:'',phone:'',course:'',year:'',status:'Active',gpa:null,dob:'',gender:'',address:'',guardian:'',guardian_phone:''};
