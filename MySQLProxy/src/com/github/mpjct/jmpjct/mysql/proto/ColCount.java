package com.github.mpjct.jmpjct.mysql.proto;

import java.util.ArrayList;

public class ColCount extends Packet {
    public long colCount = 0;
    
    @Override
    public ArrayList<byte[]> getPayload() {
        ArrayList<byte[]> payload = new ArrayList<>();
        
        payload.add(Proto.build_lenenc_int(this.colCount));
        
        return payload;
    }
    
    public static ColCount loadFromPacket(byte[] packet) {
        ColCount obj = new ColCount();
        Proto proto = new Proto(packet, 3);
        
        obj.sequenceId = proto.get_fixed_int(1);
        obj.colCount = proto.get_lenenc_int();
        
        return obj;
    }
}
