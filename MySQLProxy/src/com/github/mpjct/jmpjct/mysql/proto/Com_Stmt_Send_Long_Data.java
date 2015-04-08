package com.github.mpjct.jmpjct.mysql.proto;

import java.util.ArrayList;

public class Com_Stmt_Send_Long_Data extends Packet {
    public byte[] data;
    
    public ArrayList<byte[]> getPayload() {
        ArrayList<byte[]> payload = new ArrayList<byte[]>();
        
        payload.add(this.data);
        
        return payload;
    }
    
    public static Com_Stmt_Send_Long_Data loadFromPacket(byte[] packet) {
        Com_Stmt_Send_Long_Data obj = new Com_Stmt_Send_Long_Data();
        Proto proto = new Proto(packet, 3);
        
        obj.sequenceId = proto.get_fixed_int(1);
        
        int size = packet.length - proto.offset;
        obj.data = new byte[size];
        
        System.arraycopy(packet, proto.offset, obj.data, 0, size);

        return obj;
    }
}
