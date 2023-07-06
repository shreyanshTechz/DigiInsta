#include<bits/stdc++.h>
using namespace std;
#define ll long long int
#define f(i,n) for(ll i=1;i<=n;i++)
#define vec vector<ll>
#define all(x) (x).begin(), (x).end()
#define len(a) ((int) (a).size())
void solve(){
  ll n ; cin>>n;
  vec a(n+1);
  f(i,n) cin>>a[i];
  map<ll,ll> ans,parity;
  f(i,n) parity[i]=-1;
  f(i,n){
    // cout<<parity[a[i]]<<" ";
    if(parity[a[i]]==-1) parity[a[i]]=i%2;
    if(parity[a[i]]!=i%2){ ans[a[i]]++; parity[a[i]]=i%2;}
  }
//   cout<<"\n";
  f(i,n){
    if(parity[i]!=-1)
    cout<<++ans[i]<<" ";
    else cout<<"0 ";
  }
  cout<<"\n";
}
int main(){
ll t =1;
cin>>t;
while(t--){
  solve();
  }
return 0;
}