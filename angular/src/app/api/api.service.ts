import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Contato } from 'app/interfaces/contato';
import { Observable, catchError, of, tap } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {

  private apiBase: string = "http://localhost/api/api";
  private httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
  };

  constructor(private http: HttpClient) { }

  

  obterContatos(id:number=null): Observable<Contato[]> {
    return this.http.get<Contato[]>(this.apiBase+"/contatos"+((id==null)?'':'/'+id));
  }

  cadastrarContato(contato: Contato) {
    return this.http.post<Contato>(this.apiBase+'/contatos',contato, this.httpOptions);
  }

  deletarContato(id:number){
    return this.http.delete<Contato>(this.apiBase+'/contatos/'+id, this.httpOptions);
  }

  atualizarContato(hero: Contato,id:number): Observable<Contato> {
    return this.http.put<Contato>(this.apiBase+'/contatos/'+id, hero, this.httpOptions);
  }

}

