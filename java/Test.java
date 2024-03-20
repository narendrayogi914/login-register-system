class Test{
    int a; 
    String name;
    public static void main(String[] args){
        
        int num = 10; //premitive variable 
        Test obj = new Test();//refernce variable 
        Test onj2 = new Test();
        
        System.out.println(obj.name);
        System.out.println(obj.a);
        System.out.println(onj2.name);
        System.out.println(onj2.a);

    }
}